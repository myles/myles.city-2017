from flask import Blueprint, render_template, current_app

from .utils import get_feed_entries

frontend = Blueprint('frontend', __name__)


@frontend.route('/')
def index():
    feeds = current_app.config['FEEDS']

    entries = get_feed_entries(feeds)

    return render_template('index.html', feeds=feeds, entries=entries)[:15]
