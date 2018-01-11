[![built with gulp](https://img.shields.io/badge/gulp-built_project-eb4a4b.svg?logo=data%3Aimage%2Fpng%3Bbase64%2CiVBORw0KGgoAAAANSUhEUgAAAAYAAAAOCAMAAAA7QZ0XAAAABlBMVEUAAAD%2F%2F%2F%2Bl2Z%2FdAAAAAXRSTlMAQObYZgAAABdJREFUeAFjAAFGRjSSEQzwUgwQkjAFAAtaAD0Ls2nMAAAAAElFTkSuQmCC)](http://gulpjs.com/)
[![GitHub license](https://img.shields.io/badge/license-GPLv2-blue.svg)](https://github.com/peiche/cover/blob/master/LICENSE.txt)
[![Build Status](https://travis-ci.org/peiche/cover2.svg?branch=master)](https://travis-ci.org/peiche/cover2)

# Cover2

Cover2 is a content-driven blogging theme for WordPress. Built on top of Automattic’s Underscores, Cover2 allows you to focus on your writing. There are no sidebars to mess with, just a single column view of your content.

## Features

### Full-width featured images

When you use a featured image, it displays as a full-screen background image behind the title.

### Put widgets in their place

Cover2 puts your content first, exactly where it should be. But that doesn't mean you can't have widgets and menus, and that's where the overlay comes in.

The overlay is a full-screen menu and widget display. You can define one menu and as many widgets as your little heart desires.

Additionally, there are three footer widget positions, which collapse to a single column on small screens.

### Accent Color and Overlay Color Scheme

Customize Cover2's header color and overlay color scheme in the Customizer. Live preview shows you exactly what it'll look like before hitting Publish!

## Recommended Plugins

### Jetpack

Automattic's Jetpack plugin comes packed with modules for any theme to use, but Cover2 is designed to work nicely with these:

- **Site Logo**  
In the Customizer, you can not only set the site title and tagline, but also a site logo. You can enable and disable any combination of these three options.

- **Featured Posts**  
In the Customizer, you'll find the option to assign a specific tag to featured posts (the default is "featured"). Tagging a post will give it a special place on your blog's home page: it's displayed larger than the normal post listing, with its featured image displayed prominently behind it. If you have tagged more than one featured post, Cover2 will display them in a slider.

- **Infinite Scroll**  
The Infinite Scroll module already works just fine, and we're not messing with that. :)

### Aesop Story Engine

Cover2 was built from the ground up with Aesop Story Engine in mind. Break out of the content area with full-width components like images, galleries, maps, and more.

## Other Features

### Responsive Grid

Cover2 includes support for a basic multi-column grid which collapses down to a single column on small screens. Use the following markup in your post or page:

```
<div class="container">
  <div class="col-2">...</div>
  <div class="col-2">...</div>
</div>
```

Use these classes to define the width of your columns:
- `col-2`   Two columns, collapses to one under 600px
- `col-3`   Three columns, collapses to one under 600px
- `col-4`   Four columns, collapses to two under 900px, collapses to one under 600px 

## Installation

### GitHub

You can download the latest from GitHub. Follow these steps to activate Cover2:

1. Download the [latest release](https://github.com/peiche/cover2/releases/latest).
2. In your admin panel, go to **Appearance > Themes** and click the **Add New** button.
3. Click **Upload** and **Choose File**, then select the theme's zip file. Click **Install Now**.
4. Click **Activate**.

## FAQ

1. **How do I set the background image behind the post title?**  
   When you use a featured image in Cover2, it displays as a full-screen background image behind the title.

2. **Can I change the font size?**  
   Cover2 does not allow you to change the default font size. I recommend creating a child theme before making changes to the theme.

3. **I am receiving an error in the Customizer, what should I do?**  
   Disable any caching plugins that you may have activated.

4. **How do I make links look like buttons?**

   A normal like looks like this:
   ```
   <a href="https://wordpress.org">WordPress</a>
   ```

   To make the link look like a gray button, add the `button` class, like this:
   ```
   <a href="https://wordpress.org" class="button">WordPress</a>
   ```

   To make the link look like a button with the same link color as defined in the Customizer, add the optional `default` class, like this:
   ```
   <a href="https://wordpress.org" class="button default">WordPress</a>
   ```

## Contribute

If you see something wrong, or you want to improve on what I've got here, feel free to submit an issue or create a pull request.

## License

Cover2 is [GPL v2.0 or later](LICENSE.txt).

Image used in screenshot.png - https://unsplash.com/photos/K3uOmmlQmOo by Angelina Litvin    
License - http://creativecommons.org/publicdomain/zero/1.0/  

All other resources are licensed as follows:

* [Headroom](http://wicky.nillia.ms/headroom.js/) - [MIT](https://github.com/WickyNilliams/headroom.js/blob/master/LICENSE)
* [FlexSlider](http://flexslider.woothemes.com) - [GPL v2.0 or later](https://github.com/woocommerce/FlexSlider/blob/master/LICENSE.md)
* [Bourbon Neat](http://neat.bourbon.io/) - [MIT](https://github.com/thoughtbot/neat/blob/master/LICENSE.md)
* [Nucleo Icons](https://nucleoapp.com/) - [Standard License](https://github.com/NucleoApp/license-standard)

## Inspiration

[Icon Fonts vs. SVG](https://css-tricks.com/icon-fonts-vs-svg/)  
[The 100% Correct Way To Do CSS Breakpoints](https://medium.freecodecamp.com/the-100-correct-way-to-do-css-breakpoints-88d6a5ba1862)  
[Reponsive Display Text](https://24ways.org/2016/responsive-display-text/)  
[Align SVG Icons to Text and Say Goodbye to Font Icons](https://blog.prototypr.io/align-svg-icons-to-text-and-say-goodbye-to-font-icons-d44b3d7b26b4#.yfiiz5rca)  
[Your Body Text Is Too Small](https://blog.marvelapp.com/body-text-small/)  
