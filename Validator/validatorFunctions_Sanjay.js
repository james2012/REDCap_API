function isInteger(input) {
  if((parseFloat(input) == parseInt(input)) && !isNaN(input)){
      return true;
  } else {
      return false;
  }

}

function isNumber(input) {
  return (isInteger(input) && input > 0);

}

function withinRange(input, min, max) {
     return (input > min && input <= max);   
}

function isIntegerWithinRange(input, min, max) {
  return (isInteger(input) && withinRange(input, min, max));

}

