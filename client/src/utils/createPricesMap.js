function createPricesMap(productPrices) {
  return Object.fromEntries(
    productPrices.map((price) => [
      price.currency_symbol,
      price.amount,
    ])
  );
}

export default createPricesMap;
