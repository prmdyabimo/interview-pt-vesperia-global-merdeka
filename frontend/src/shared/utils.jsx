export const formatDate = (dateString) => {
  if (!dateString) return "";

  const date = new Date(dateString);
  return date.toISOString().split("T")[0];
};

export const validateForm = (formValues, FormFields) => {
  const errors = {};

  FormFields.forEach((field) => {
    const value = formValues[field.id];

    if (!value || (Array.isArray(value) && value.length === 0)) {
      errors[field.id] = `${field.label} wajib diisi`;
    }
  });

  return {
    isValid: Object.keys(errors).length === 0,
    errors,
  };
};

export const generateId = () => {
  return Date.now().toString(36) + Math.random().toString(36).substr(2);
};
