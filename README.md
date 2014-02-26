Secure PHP Blog
===============

About
-----

Student project aiming to develop a secure PHP application (blog),
developed with [Roman MKRTCHIAN](https://github.com/nam0r) as part
of the WASP (Web Application Security) course at
[Polytech Nice Sophia](http://www.polytechnice.fr/informatique/page251.html)
(5th year, 2012-2013).

The project is written using HTML5 and CSS3 so be sure to use a recent web
browser for the best experience.

The project makes use of:
  * [Disqus](http://disqus.com/) for comments
  * [ReCaptcha](http://www.google.com/recaptcha) to prevent robots from spamming the blog with unwanted comments
  * [Redbean](http://redbeanphp.com/) for Object-Relational Mapping
  * [CKEditor](http://ckeditor.com/) for WYSIWYG edition of blog entries
  * [HTML Purifier](http://htmlpurifier.org/) for malicious code filtering
  * [Bootstrap](http://getbootstrap.com/) for the layout

For detailed information (in French), you can read
[this document](https://raw.github.com/Afnarel/Secure-PHP-Blog/master/rapport.pdf).

Setup
-----

First, you need to create a database. By default, this is a MySQL database,
though you can change this by editing the `DB_DSN_PDO` variable. Edit the
`DB_HOST`, `DB_NAME`, `DB_USER` and `DB_PASSWORD` variables to match your
configuration.

The project comes with a wasp.sql sample database dump which you can import using
a tool such as PHPMyAdmin or by running a command such as
`mysql -p -u root database_name < wasp.sql`.
This dump contains a test user (login: user@yopmail.com, password: password)
and a few post so that you can quickly see what the blog posts look like.

Create a ReCaptcha account and update the `RECAPTCHA_PUBLICKEY` and
`RECAPTCHA_PRIVATEKEY` variables with the public and private key provided by
the ReCaptcha service.

You must then configure the SMTP server that will be used to send emails to
the users of the blog. The default setup.php file is configured to use a GMail
account but you will need to update the `SMTP_LOGIN` and `SMTP_PASSWORD`
variables with your GMail login and password.

You will probably need to update the `DOMAIN` and `ROOTPATH` variables. For
instance if you wish to make the project available at http://domain.com/blog/,
set DOMAIN to 'http://domain.com' and ROOTPATH to '/blog/'.

If you want this blog to really be secure, you need to change the `SALT`
variable since the default one is published publicly. However, if you do
this, previously created account will become invalid, including the one
from the sample database.


Authors
-------

François CHAPUIS - [Afnarel](http://afnarel.com/)
Roman MKRTCHIAN - [nam0r](https://github.com/nam0r)

License
-------

This project is distributed under the terms of the
[Creative Commons CC-BY-SA](http://creativecommons.org/licenses/by-sa/4.0/legalcode)
license.
