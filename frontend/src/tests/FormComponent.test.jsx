import React from "react";
import { render, screen, fireEvent, waitFor } from "@testing-library/react";
import "@testing-library/jest-dom";
import FormInput from "../presentation/components/FormInput";
import Navigation from "../presentation/components/Navigation";

// Mock data untuk testing
const mockTextField = {
  id: "test-field",
  label: "Test Field",
  type: "text",
  subType: "text",
  description: "This is a test field",
};

const mockDateField = {
  id: "test-date",
  label: "Test Date",
  type: "text",
  subType: "date",
  description: "This is a test date field",
};

const mockAmountField = {
  id: "test-amount",
  label: "Test Amount",
  type: "text",
  subType: "amount",
  description: "This is a test amount field",
};

const mockRadioField = {
  id: "test-radio",
  label: "Test Radio",
  type: "radio_button",
  description: "This is a test radio field",
  options: [
    { id: "option1", label: "Option 1" },
    { id: "option2", label: "Option 2" },
  ],
};

const mockCheckboxField = {
  id: "test-checkbox",
  label: "Test Checkbox",
  type: "checkbox",
  description: "This is a test checkbox field",
  options: [
    { id: "cb1", label: "Checkbox 1" },
    { id: "cb2", label: "Checkbox 2" },
    { id: "cb3", label: "Checkbox 3" },
  ],
};

const mockLongTextField = {
  id: "test-textarea",
  label: "Test Textarea",
  type: "long_text",
  description: "This is a test textarea field",
};

describe("FormInput Component", () => {
  const mockOnChange = jest.fn();

  beforeEach(() => {
    mockOnChange.mockClear();
  });

  test("renders text input correctly", () => {
    render(
      <FormInput field={mockTextField} value="" onChange={mockOnChange} />
    );

    expect(screen.getByLabelText("Test Field")).toBeInTheDocument();
    expect(screen.getByText("This is a test field")).toBeInTheDocument();
    expect(screen.getByDisplayValue("")).toBeInTheDocument();
  });

  test("renders date input correctly", () => {
    render(
      <FormInput
        field={mockDateField}
        value="2024-01-01"
        onChange={mockOnChange}
      />
    );

    const input = screen.getByLabelText("Test Date");
    expect(input).toBeInTheDocument();
    expect(input.type).toBe("date");
  });

  test("renders amount input with formatting", () => {
    render(
      <FormInput
        field={mockAmountField}
        value="1000000"
        onChange={mockOnChange}
      />
    );

    expect(screen.getByDisplayValue("1.000.000")).toBeInTheDocument();
    expect(screen.getByText(/Format: 1\.000\.000 Rupiah/)).toBeInTheDocument();
  });

  test("renders radio button correctly", () => {
    render(
      <FormInput field={mockRadioField} value={[]} onChange={mockOnChange} />
    );

    expect(screen.getByText("Test Radio")).toBeInTheDocument();
    expect(screen.getByLabelText("Option 1")).toBeInTheDocument();
    expect(screen.getByLabelText("Option 2")).toBeInTheDocument();
  });

  test("renders checkbox correctly", () => {
    render(
      <FormInput field={mockCheckboxField} value={[]} onChange={mockOnChange} />
    );

    expect(screen.getByText("Test Checkbox")).toBeInTheDocument();
    expect(screen.getByLabelText("Checkbox 1")).toBeInTheDocument();
    expect(screen.getByLabelText("Checkbox 2")).toBeInTheDocument();
    expect(screen.getByLabelText("Checkbox 3")).toBeInTheDocument();
  });

  test("renders textarea correctly", () => {
    render(
      <FormInput field={mockLongTextField} value="" onChange={mockOnChange} />
    );

    expect(screen.getByLabelText("Test Textarea")).toBeInTheDocument();
    expect(screen.getByRole("textbox")).toBeInTheDocument();
  });

  test("handles text input change", () => {
    render(
      <FormInput field={mockTextField} value="" onChange={mockOnChange} />
    );

    const input = screen.getByLabelText("Test Field");
    fireEvent.change(input, { target: { value: "test value" } });

    expect(mockOnChange).toHaveBeenCalledWith("test-field", "test value");
  });

  test("handles radio button change", () => {
    render(
      <FormInput field={mockRadioField} value={[]} onChange={mockOnChange} />
    );

    const radio = screen.getByLabelText("Option 1");
    fireEvent.click(radio);

    expect(mockOnChange).toHaveBeenCalledWith("test-radio", [
      { id: "option1", label: "Option 1" },
    ]);
  });

  test("handles checkbox change", () => {
    render(
      <FormInput field={mockCheckboxField} value={[]} onChange={mockOnChange} />
    );

    const checkbox = screen.getByLabelText("Checkbox 1");
    fireEvent.click(checkbox);

    expect(mockOnChange).toHaveBeenCalledWith("test-checkbox", [
      { id: "cb1", label: "Checkbox 1" },
    ]);
  });

  test("handles multiple checkbox selections", () => {
    const existingValue = [{ id: "cb1", label: "Checkbox 1" }];

    render(
      <FormInput
        field={mockCheckboxField}
        value={existingValue}
        onChange={mockOnChange}
      />
    );

    const checkbox2 = screen.getByLabelText("Checkbox 2");
    fireEvent.click(checkbox2);

    expect(mockOnChange).toHaveBeenCalledWith("test-checkbox", [
      { id: "cb1", label: "Checkbox 1" },
      { id: "cb2", label: "Checkbox 2" },
    ]);
  });

  test("handles amount input formatting", () => {
    render(
      <FormInput field={mockAmountField} value="" onChange={mockOnChange} />
    );

    const input = screen.getByLabelText("Test Amount");
    fireEvent.change(input, { target: { value: "1.000.000" } });

    expect(mockOnChange).toHaveBeenCalledWith("test-amount", "1000000");
  });
});

describe("Navigation Component", () => {
  const mockOnPageChange = jest.fn();

  beforeEach(() => {
    mockOnPageChange.mockClear();
  });

  test("renders navigation correctly", () => {
    render(
      <Navigation currentPage="kejadian" onPageChange={mockOnPageChange} />
    );

    expect(screen.getByText("Form Management System")).toBeInTheDocument();
    expect(screen.getByText("Detail Kejadian Risiko")).toBeInTheDocument();
    expect(screen.getByText("Detail Kerugian")).toBeInTheDocument();
  });

  test("handles page change", () => {
    render(
      <Navigation currentPage="kejadian" onPageChange={mockOnPageChange} />
    );

    const kerugianButton = screen.getByText("Detail Kerugian");
    fireEvent.click(kerugianButton);

    expect(mockOnPageChange).toHaveBeenCalledWith("kerugian");
  });

  test("shows active page correctly", () => {
    render(
      <Navigation currentPage="kerugian" onPageChange={mockOnPageChange} />
    );

    const activeButton = screen.getByText("Detail Kerugian");
    expect(activeButton).toHaveClass("active");
  });
});
