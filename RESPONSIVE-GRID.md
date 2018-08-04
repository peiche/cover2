# Responsive 12-Column Grid

## Create a container and row

Grid columns must be nested inside `.container` and `.grid-row` elements.

```
<div class="container">
    <div class="grid-row">
    </div>
</div>
```

The `.container` class has a default width of 800px. To set a different width, use these optional classes:

`<div class="container narrow">` - 500px
`<div class="container small">` - 640px
`<div class="container large">` - 1000px

## Create columns inside the row

The grid system is a fully responsive 12-column grid. The base class used for columns is `.grid-col-[#]`, where `#` is the column width.

Because the grid is mobile first, the base class targets the smallest screen size. This can be overridden by including additional classes with the syntax `.grid-col-[size]-[#]`, where `[size]` corresponds to the following sizes:

`sm` - 600px (tablet portrait)
`md` - 900px (tablet landscape)
`lg` - 1200px (desktop)

By stacking these classes, it is possible to define a four-column content area on desktop (`-lg-3`), which collapses to three on tablet landscape (`-md-4`), two on tablet portrait (`-sm-6`), and one column on smartphones (`-12`). 

```
<div class="grid-col-12 grid-col-sm-6 grid-col-md-4 grid-col-lg-3">
```

The entire markup, including container and row, would be as follows (for 4 columns on content):

```
<div class="container">
    <div class="grid-row">
        <div class="grid-col-12 grid-col-sm-6 grid-col-md-4 grid-col-lg-3">
            // Column 1
        </div>
        <div class="grid-col-12 grid-col-sm-6 grid-col-md-4 grid-col-lg-3">
            // Column 2
        </div>
        <div class="grid-col-12 grid-col-sm-6 grid-col-md-4 grid-col-lg-3">
            // Column 3
        </div>
        <div class="grid-col-12 grid-col-sm-6 grid-col-md-4 grid-col-lg-3">
            // Column 4
        </div>
    </div>
</div>
```

_Note: I would much prefer the class syntax of `.row` and `.col-`, but I'm trying not to introduce conflicts with existing grid framework plugins._
