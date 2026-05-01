// hooks/usePrice.js
import { useMemo } from "react";
import createPricesMap from "../utils/createPricesMap";
import { usePrefferedCurrency } from "../context/PrefferedCurrencyContext";

export function usePricesMap(productPrices) {
  const { currency: preferredCurrency } = usePrefferedCurrency();

  return useMemo(() => {
    if (!productPrices?.length) {
      return {
        amount: 0,
        currency: preferredCurrency,
        pricesMap: {},
      };
    }

    const pricesMap = createPricesMap(productPrices);
    const amount = pricesMap[preferredCurrency] ?? Object.values(pricesMap)[0];

    return {
      amount,
      currency:
        preferredCurrency in pricesMap
          ? preferredCurrency
          : Object.keys(pricesMap)[0],
      pricesMap,
    };
  }, [productPrices, preferredCurrency]);
}
