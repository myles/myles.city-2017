from time import mktime
from datetime import datetime
from operator import attrgetter
from html.parser import HTMLParser

import feedparser


class ExtractImagesHTMLParser(HTMLParser):
    """
    Finds all the Images.
    """
    def __init__(self):
        HTMLParser.__init__(self)
        self.image_url = ''
        self.no_img_html = ''

    def handle_starttag(self, tag, attrs):
        if tag == 'img':
            for a in attrs:
                if a[0] == 'src':
                    self.image_url = a[1]
        else:
            self.no_img_html += self.get_starttag_text()

    def handle_endtag(self, tag):
        if tag != 'img':
            self.no_img_html += '</%s>' % tag

    def handle_data(self, data):
        self.no_img_html += data
        self.text = data


def get_feed_entries(feeds):
    entries = []

    for feed in feeds:
        d = feedparser.parse(feed.get('feed_url'))

        for entry in d.entries:
            entry.publisher = feed['title']
            # entry.publisher_icon = feed['icon']

            if 'media_content' in entry:
                if entry.media_content[0]['medium'] == 'image':
                    entry.image = entry.media_content[0]['url']
            else:
                parser = ExtractImagesHTMLParser()
                parser.feed(entry.description)

                entry.image = parser.image_url

            entry.published = datetime.fromtimestamp(mktime(entry.published_parsed))

            entries.append(entry)

    return sorted(entries, key=attrgetter('published'), reverse=True)
