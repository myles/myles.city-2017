from time import mktime
from datetime import datetime
from operator import attrgetter

import feedparser
from bs4 import BeautifulSoup


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
            elif 'content' in entry:
                soup = BeautifulSoup(entry.content[0]['value'], 'html.parser')
                image = soup.find_all('img')[0]
                entry.image = image.get('src')

            published = datetime.fromtimestamp(mktime(entry.published_parsed))
            updated = datetime.fromtimestamp(mktime(entry.updated_parsed))

            entry.published = published
            entry.updated = updated

            entries.append(entry)

    return sorted(entries, key=attrgetter('published'), reverse=True)
