function formatCRM(input) {
  let value = input.value.replace(/[^a-zA-Z0-9]/g, "");
  let formattedValue = "";

  if (value.length > 0) {
    formattedValue =
      "CRM-CE" +
      value.substring(0, 2).toUpperCase() +
      ": " +
      value.substring(2, 8);
  }

  input.value = formattedValue;
}
