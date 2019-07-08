# Snap Products

## Create a database

```sql
CREATE DATABASE IF NOT EXISTS snap_products;
CREATE USER 'snapUser'@'localhost' IDENTIFIED BY 'test1234';
GRANT ALL PRIVILEGES ON snap_prodcuts. * TO 'snapUser'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;
```

## Login credentials:

Username: admin
Password: eGrahs2cQaNf5QIYH@

## On top of every page!
```php
<?php
  global $language;

  update_language();
?>
```