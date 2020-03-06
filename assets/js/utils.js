const years = {
  2020: 'A',
  2021: 'B',
  2022: 'C',
  2023: 'D',
  2024: 'E',
  2025: 'F',
  2026: 'G',
  2027: 'H',
  2028: 'I',
  2029: 'J',
  2030: 'K'
}

const months = {
  1: 'A',
  2: 'B',
  3: 'C',
  4: 'D',
  5: 'E',
  6: 'F',
  7: 'G',
  8: 'H',
  9: 'I',
  10: 'J',
  11: 'K',
  12: 'L'
}

module.exports = {
  formatDigits: function (number, digits = 0) {
    return new Intl.NumberFormat("en-US", { maximumSignificantDigits: digits }).format(number)
  },
  getCode: function (codes) {
    const date = new Date()
    const prefix = `${years[date.getFullYear}${months[date.getMonth]}`
    return prefix
  }
}