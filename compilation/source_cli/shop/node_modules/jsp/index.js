module.exports = parse;

/**
 * Nicer JSON.parse() with convenient error handling.
 *
 * Do this:
 *
 *   var parsed = parse(raw);
 *   cb(parsed.err, parsed.json);
 *
 * Instead of this:
 *
 *   var parsed;
 *   try {
 *     parsed = JSON.parse(raw);
 *   } catch (err) {
 *     return cb(err);
 *   }
 *   cb(null, parsed);
 *
 * @param {String} raw
 * @return {Object}
 */

function parse (raw) {
  var ret = { error : null, json : null };
  try {
    ret.json = JSON.parse(raw);
  } catch (err) {
    ret.err = err;
  }
  return ret;
}
