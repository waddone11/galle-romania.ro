<?php

namespace App\Support;

/**
 * Markdown-lite securizat pentru continutul articolelor de blog.
 *
 * Acelasi principiu ca blocks/sectiune_text: escapam TOT continutul,
 * apoi permitem doar un subset controlat de sintaxa markdown —
 * subtitluri (##/###), liste cu `- `, **bold** si link-uri interne
 * [text](/url). Orice HTML din continut ramane escapat.
 */
class BlogMarkdown
{
    public static function toHtml(string $text): string
    {
        $escaped = e(str_replace("\r\n", "\n", $text));
        $blocks = preg_split("/\n{2,}/", $escaped) ?: [];

        $html = [];
        foreach ($blocks as $block) {
            $block = trim($block);
            if ($block === '') {
                continue;
            }

            if (str_starts_with($block, '### ')) {
                $html[] = '<h3 class="font-display text-xl font-semibold text-forest mt-8 mb-3">'
                    .self::inline(substr($block, 4)).'</h3>';
            } elseif (str_starts_with($block, '## ')) {
                $html[] = '<h2 class="font-display text-2xl font-semibold text-forest mt-10 mb-4">'
                    .self::inline(substr($block, 3)).'</h2>';
            } elseif (str_starts_with($block, '- ')) {
                $items = array_map(
                    fn (string $line): string => '<li>'.self::inline(preg_replace('/^- /', '', trim($line)) ?? '').'</li>',
                    explode("\n", $block)
                );
                $html[] = '<ul class="list-disc pl-6 space-y-2 mb-5">'.implode('', $items).'</ul>';
            } else {
                $html[] = '<p class="mb-5">'.nl2br(self::inline($block)).'</p>';
            }
        }

        return implode("\n", $html);
    }

    /** Bold + link-uri interne markdown — singurele elemente inline permise. */
    private static function inline(string $text): string
    {
        $text = (string) preg_replace('/\*\*([^*]+)\*\*/', '<strong>$1</strong>', $text);

        return (string) preg_replace(
            '/\[([^\]]+)\]\((\/[^)\s]*)\)/',
            '<a href="$2" class="font-semibold text-forest underline underline-offset-2 hover:text-mint transition-colors">$1</a>',
            $text
        );
    }
}
