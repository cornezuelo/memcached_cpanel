# memcached_cpanel
A simple, lightweight, responsive control panel for memcached to perform basic operations over keys (Get and delete)

# Configuration
Make a copy of conf.php.default to conf.php, or run index.php and it will be autocopied.

You can configure your host and port (localhost and 11211 by default) in the conf.php file, and you're ready to go!

$delete_tags flag: If true, if you delete a key that begins with "tag!", it will also delete the keys that are inside saved as an array.