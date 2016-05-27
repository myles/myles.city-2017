from werkzeug.contrib.atom import AtomFeed
from flask import Blueprint, render_template, current_app, request, Response

from .utils import get_feed_entries

frontend = Blueprint('frontend', __name__)


@frontend.route('/')
def index():
    feeds = current_app.config['FEEDS']

    entries = get_feed_entries(feeds)

    return render_template('index.html', feeds=feeds, entries=entries[:15])


@frontend.route('/feed.xml')
def atom_feed():
    feeds = current_app.config['FEEDS']

    feed = AtomFeed('The City of Myles', feed_url=request.url,
                    url=request.url_root)

    entries = get_feed_entries(feeds)[:20]

    for entry in entries:
        feed.add(entry.title, entry.description, context_type='html',
                 author=entry.publisher, url=entry.link,
                 published=entry.published, updated=entry.updated)

    return Response(feed.to_string(), mimetype="application/xml")
