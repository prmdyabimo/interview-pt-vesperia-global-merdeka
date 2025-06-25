import React from "react";

const FormInput = ({ field, value, onChange }) => {

  const handleRadioChange = (optionId, optionLabel) => {
    onChange(field.id, [{ id: optionId, label: optionLabel }]);
  };

  const handleCheckboxChange = (optionId, optionLabel) => {
    const currentValue = value || [];
    const isChecked = currentValue.some((item) => item.id === optionId);

    if (isChecked) {
      // Remove from selection
      const newValue = currentValue.filter((item) => item.id !== optionId);
      onChange(field.id, newValue);
    } else {
      // Add to selection
      const newValue = [...currentValue, { id: optionId, label: optionLabel }];
      onChange(field.id, newValue);
    }
  };

  const handleTextChange = (e) => {
    onChange(field.id, e.target.value);
  };

  const formatCurrency = (value) => {
    if (!value) return "";

    const numericValue = value.replace(/[^\d]/g, "");
    return new Intl.NumberFormat("id-ID").format(numericValue);
  };

  const handleAmountChange = (e) => {
    const rawValue = e.target.value.replace(/[^\d]/g, "");
    onChange(field.id, rawValue);
  };

  const renderCheckbox = () => (
    <div className="form-group">
      <label className="form-label">{field.label}</label>
      <p className="form-description">{field.description}</p>
      <div className="checkbox-group">
        {field.options &&
          field.options.map((option) => {
            const isChecked =
              value && value.some((item) => item.id === option.id);
            return (
              <div key={option.id} className="checkbox-item">
                <input
                  type="checkbox"
                  id={option.id}
                  checked={isChecked}
                  onChange={() => handleCheckboxChange(option.id, option.label)}
                />
                <label htmlFor={option.id}>{option.label}</label>
              </div>
            );
          })}
      </div>
    </div>
  );

  const renderRadioButton = () => (
    <div className="form-group">
      <label className="form-label">{field.label}</label>
      <p className="form-description">{field.description}</p>
      <div className="radio-group">
        {field.options &&
          field.options.map((option) => (
            <div key={option.id} className="radio-item">
              <input
                type="radio"
                id={option.id}
                name={field.id}
                checked={value && value.length > 0 && value[0].id === option.id}
                onChange={() => handleRadioChange(option.id, option.label)}
              />
              <label htmlFor={option.id}>{option.label}</label>
            </div>
          ))}
      </div>
    </div>
  );

  const renderTextInput = () => {
    let inputType = "text";
    let inputValue = value || "";
    let onChangeHandler = handleTextChange;

    if (field.sub_type == "date") {
      inputType = "date";
    } else if (field.sub_type == "amount") {
      inputValue = formatCurrency(value || "");
      onChangeHandler = handleAmountChange;
    }

    return (
      <div className="form-group">
        <label className="form-label" htmlFor={field.id}>
          {field.label}
        </label>
        <p className="form-description">{field.description}</p>
        <input
          type={inputType}
          id={field.id}
          className="form-input"
          value={inputValue}
          onChange={onChangeHandler}
          placeholder={
            field.sub_type === "amount" ? "Masukkan nominal dalam Rupiah" : ""
          }
        />
        {field.sub_type === "amount" && (
          <small className="amount-helper">
            Format: {formatCurrency(value || "0")} Rupiah
          </small>
        )}
      </div>
    );
  };

  const renderLongText = () => (
    <div className="form-group">
      <label className="form-label" htmlFor={field.id}>
        {field.label}
      </label>
      <p className="form-description">{field.description}</p>
      <textarea
        id={field.id}
        className="form-textarea"
        rows="4"
        value={value || ""}
        onChange={handleTextChange}
      />
    </div>
  );

  switch (field.type) {
    case "checkbox":
      return renderCheckbox();
    case "radio_button":
      return renderRadioButton();
    case "text":
      return renderTextInput();
    case "long_text":
      return renderLongText();
    default:
      return (
        <div className="form-group">
          <p>Unknown field type: {field.type}</p>
        </div>
      );
  }
};

export default FormInput;
