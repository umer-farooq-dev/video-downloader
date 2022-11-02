<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">


    @foreach ($pages as $page)

        @switch( $page->type )
            @case('default')
            @case('downloader')
            @case('contact')

                 @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                     <url>
                        <loc>{{ localization()->getLocalizedURL($properties->key(), route('home') . '/' . $page->slug, [], false) }}</loc>
                        <lastmod>{{ $page->updated_at->tz('UTC')->toAtomString() }}</lastmod>
                        <priority>1.00</priority>
                    </url>
                 @endforeach

            @break

            @case('home')

                 @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                     <url>
                        <loc>{{ localization()->getLocalizedURL($properties->key(), route('home'), [], false) }}</loc>
                        <lastmod>{{ $page->updated_at->tz('UTC')->toAtomString() }}</lastmod>
                        <priority>1.00</priority>
                    </url>
                 @endforeach

            @break

            @default
        @endswitch

    @endforeach
</urlset>