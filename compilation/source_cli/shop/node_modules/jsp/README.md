
# jsp

A nicer JSON.parse() with convenient error handling.

[![Build Status](https://travis-ci.org/juliangruber/jsp.png?branch=master)](https://travis-ci.org/juliangruber/jsp)

## Usage

Lets you do this:

```js
var parse = require('jsp');

var parsed = parse(raw);
cb(parsed.err, parsed.json);
```

Instead of this:

```js
var parsed;
try {
  parsed = JSON.parse(raw);
} catch (err) {
  return cb(err);
}
cb(null, parsed);
```

## API

### parse(raw)

`JSON.parse(raw)` and return `{ err : Error, json : JSON }`.

## Installation

With [npm](http://npmjs.org) do

```bash
$ npm install jsp
```

With [component](https://github.com/component/component) do

```bash
$ component install juliangruber/jsp
```

## License

(MIT)

Copyright (c) 2013 Julian Gruber &lt;julian@juliangruber.com&gt;

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
