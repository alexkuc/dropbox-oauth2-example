# README

This small repo shows how to use [spatie/dropbox-api](https://github.com/spatie/dropbox-api) with [stevenmaguire/oauth2-dropbox](https://github.com/stevenmaguire/oauth2-dropbox) to take advantage of Dropbox refresh tokens as

> In the past, the Dropbox API used only long-lived access tokens. These are now deprecated, but will remain available as an option in the Developer console for compatibility until mid 2021.

source: https://www.dropbox.com/lp/developers/reference/oauth-guide

## Getting Started

1. git clone
2. composer install
3. php -S localhost:8080
4. navigate to http://localhost:8080/index.php
5. obtain authorization code from Dropbox (1st link)
6. obtain token (2nd input)
7. click on any buttons
