# API

POST to the server with the following values.

## `type`
(Required)

- ### `render`
    Renders the image.

- ### `refresh`
    Not implemented yet.

## `content`
(required if type is `render`)

The HTML content which will be rendered.

## `height`
(optional)

Use this to set the height of the screenshot.

Without setting this, the `width` attribute won't work either.

If the `height` is set to a value that is lower than what's required to fit all the content, the entire page will be printed (height value will be ignored).

## `width`
(optional)

Use this this to set the `width` of the screenshot.

Won't work if `height` isn't set.
