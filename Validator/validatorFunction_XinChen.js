/**
 * Validate that given value is a number
 *
 * @param {String} input
 * @return {Boolean}
 */

var isInteger = function(input) {
 return input !== '' && input.replace(/[0-9]/g, '') === '';
}


