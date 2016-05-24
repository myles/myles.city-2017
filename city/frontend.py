from flask import Blueprint, render_template

from .utils import get_feed_entries

frontend = Blueprint('frontend', __name__)


@frontend.route('/')
def index():
    entries = get_feed_entries()

    return render_template('index.html', entries=entries)
