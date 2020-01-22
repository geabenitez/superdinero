module.exports = {
  formatDigits: function (number, digits = 0) {
    return new Intl.NumberFormat("en-US", { maximumSignificantDigits: digits }).format(number)
  }
}