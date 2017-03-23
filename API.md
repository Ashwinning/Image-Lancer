# API

POST to the server with the following values.

## `type`
(Required)

- ### `render-content`
    Renders the image.
    Requires `content` to be HTML.

- ### `render-url`
    Renders the image.
    Requires `content` to be a URL.

- ### `refresh`
    Not implemented yet.

## `content`
(required if type is `render-content` or `render-url`)

The HTML content or URL.
Make sure `type` is set correctly.

## `height`
(optional)

Use this to set the height of the screenshot.

Without setting this, the `width` attribute won't work either.

If the `height` is set to a value that is lower than what's required to fit all the content, the entire page will be printed (height value will be ignored).

## `width`
(optional)

Use this this to set the `width` of the screenshot.

Won't work if `height` isn't set.

### Example curl request
```bash
curl --request POST \
  --url http://192.168.99.100/ \
  --form type=render \
  --form 'content=<html><head><style>.section {background-image: -webkit-linear-gradient(270deg, rgba(46, 117, 173, .55), rgba(46, 117, 173, .55));   background-image: linear-gradient(180deg, rgba(46, 117, 173, .55), rgba(46, 117, 173, .55));   color: #fff; }  .text-block {   position: static;   display: block;   overflow: visible;   height: auto;   font-size: 65px; }  .div-block {   background-image: -webkit-linear-gradient(270deg, #ffc0c0, #fff);   background-image: linear-gradient(180deg, #ffc0c0, #fff); }</style></head><body bgcolor="white" width="1000px">   <div class="w-container">     <h1>A test we'\''re going to render.</h1>   </div>   <div class="w-container">     <div class="div-block">       <ul>         <li>something</li>         <li>something</li>         <li>something else</li>       </ul>       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.</p>       <blockquote class="block-quote">We'\''ll test a quote out here</blockquote>     </div>   </div> </body></html>' \
  --form width=800 \
  --form height=120
```
