// src/setupTests.js
import "@testing-library/jest-dom";

// Mock untuk console.log agar tidak muncul di test output
global.console = {
  ...console,
  log: jest.fn(),
  debug: jest.fn(),
  info: jest.fn(),
  warn: jest.fn(),
  error: jest.fn(),
};
