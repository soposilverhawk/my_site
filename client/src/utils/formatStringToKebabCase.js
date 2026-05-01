function formatStringToKebabCase(string) {
  return string.replace(/\s+/g, "-").toLowerCase();
}

export default formatStringToKebabCase;
