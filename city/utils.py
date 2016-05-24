from time import mktime
from operator import itemgetter
from datetime import datetime

import feedparser

feeds = [
    {
        'title': 'I Love/Hate Myles',
        'url': 'https://ilovemyles.com/',
        'feed_url': 'https://ilovemyles.com/rss/',
        'icon': 'https://ilovemyles.com/content/images/2016/05/logomark-1.png'
    },
    {
        'title': 'Myles\' Life',
        'url': 'https://myles.life/',
        'feed_url': 'https://myles.life/feed/'
    }
]


def get_feed_entries():
    entries = []

    for feed in feeds:
        d = feedparser.parse(feed.get('feed_url'))

        for entry in d.entries:
            entry.publisher = feed['title']
            # entry.publisher_icon = feed['icon']

            if 'media_content' in entry:
                if entry.media_content[0]['medium'] == 'image':
                    entry.image = entry.media_content[0]['url']

            entry.published = datetime.fromtimestamp(mktime(entry.published_parsed))

            entries.append(entry)

    return sorted(entries, key=itemgetter('published'), reverse=True)
