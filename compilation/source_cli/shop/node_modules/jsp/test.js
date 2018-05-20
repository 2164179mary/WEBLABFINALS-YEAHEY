var test = require('tape');
var parse = require('./');

test('valid', function (t) {
  var raw = JSON.stringify({ some : 'json' });
  var parsed = parse(raw);

  t.error(parsed.err, 'no error');
  t.deepEqual(parsed.json, { some : 'json' }, 'parsed JSON');

  t.end();
});

test('invalid', function (t) {
  var raw = '{ some';
  var parsed = parse(raw);

  t.ok(parsed.err, 'got error');
  t.notOk(parsed.JSON, 'no JSON');

  t.end();
});
