## rtl-scss-kit
rtl-scss-kit is a collection of mixin files which will help to build the specific stylesheets for right to left and left to right platform without post-processing css.

## the problem
when we write stylesheets for right to left platforms we have basically have to mirror all properties like margin-left, float, border-right and so on. When we need a float: left in our ltr stylesheet in the rtl stylesheet we will need to flip this to float: right

## the solution in scss
use the global ltr/rtl definitions and include them.
```
// import ltr-config
@import "foundation/ltr";
// styles
@import "site";
```
and the corresponding rtl base file include the rtl-config
```
// import rtl-config
@import "foundation/rtl";
// import styles
@import "site";
```
the global rtl/ltr config files are responsible for setting the global left/right defintions:
```
// _ltr.scss
$left: left;
$right: right;
$dir: ltr;
```
```
// _rtl.scss
$left: right;
$right: left;
$dir: rtl;
```
we can then make usage of the mixin which will produce the according left and right properties for our layout. e.g.
```
// _nav.scss
.navigation {
  @include float(left);
}
```
will result in
```
// base.ltr.css
.navigation {
  float: left;
}
```
in the base ltr stylesheet and in
```
// base.rtl.css
.navigation {
  float: right;
}
```
in rtl base stylesheet

## the solution in twig
with twig and template inheritance and usage of block statements we can easily adapt to load only the specific stylesheet and also exchange dir-attributes on the html-node
```
// index.php
if ($viewtype == "rtl") {
    echo $twig->render('base.rtl.twig');
}
else {
    echo $twig->render('base.twig');
}
```
the base file defines the blocks and structure
```
<!DOCTYPE html>
<html {% block dirattr %}dir="ltr"{% endblock %}>
<head>
    {% block metatags %}
        <meta charset="utf-8">
    {% endblock %}
    <title>rtl-scss-kit</title>
    {% block stylesheets %}
        <link rel="stylesheet" href="css/base.ltr.css">
    {% endblock %}
</head>
<body>
</body>
</html>
```
we inheritate the base-template for the right-to-left layouts from the main template and replace the markup and stylesheet location
```
{% extends "base.twig" %}
{% block dirattr %}dir="rtl"{% endblock %}
{% block stylesheets %}
    <link rel="stylesheet" href="css/base.rtl.css">
{% endblock %}
```

## view demo with twig
you need php a webserver and composer installed. clone the repo and run
```
composer install
```
open index.php in your browser
