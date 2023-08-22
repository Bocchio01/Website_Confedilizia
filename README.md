# Confedilizia WebSite

The main role of this repo is to securely manage (using private tokens and a bit of server configuration) the sale of a simple software I have built.

Using a MySQL database, buyer data is stored in an orderly manner, as are incoming orders and requests.
The code does not manage the payment of products, which must be handled separately (e.g. via a normal bank transaction).

## First attempt

This was probably the first real project I worked on after the _C language_ period in high school.

Starting from the template of the [ConfediliziaComo's website](http://www.confediliziacomo.it), I played around a bit with PHP and MySQL databases, which were new to me.

In a few weeks, and a lot of googling, I reached a more or less working solution. I knew it was far from perfect, but I didn't know how to improve it.

## Rebuilding

Opening the repo after a couple of years forced me to finish what I had left behind due to my lack of knowledge. And so I did.

Main improvements were:

- Improved database structure;
- Improved queries performance;
- Breakdown of the code into more functions and template files;
- Increased control over server configuration (.htacces files) to protect software from unauthorized download and hide private files;
- Improved logging function to keep track of errors during queries or unauthorized requests to private files;
- Much more detailed and useful analytics page;
- Completely rebuilt HTML and CSS from scratch, moving from the old style structure as a table element to a much more flexible and responsive design.

### External libraries

As far as libraries are concerned, the only one needed is:

- [PHPlot](https://sourceforge.net/projects/phplot/): used to generate the graphs for the analytics page.

Download and extract the files from the zip folder. Create a new _\_lib_ folder in the root level of the repo and place the files there. The final structure should be:

```bash
├── _lib
│   └── phplot-6.2.0
├── assets
│   ├── img
│   ...
...
```

## Current result

The site is online and is ready to handle your orders on the software (even if you are not in Como, you can always request the demo version which is free... :) ).

Or, if you are just interested in seeing the site in action, come and [visit it at this link](https://attestazioniaffitti.altervista.org/).

Have a nice coding day,

Tommaso 🐼
