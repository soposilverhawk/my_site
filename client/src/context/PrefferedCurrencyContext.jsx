import { createContext, useContext, useState } from "react";

const PrefferedCurrencyContext = createContext();

export const PrefferedCurrencyProvider = ({ children }) => {
  const [currency, setCurrency] = useState("$");

  return (
    <PrefferedCurrencyContext.Provider value={{ currency, setCurrency }}>
      {children}
    </PrefferedCurrencyContext.Provider>
  );
};

export const usePrefferedCurrency = () => useContext(PrefferedCurrencyContext);
