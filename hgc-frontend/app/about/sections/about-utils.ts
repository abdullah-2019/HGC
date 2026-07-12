"use client";

/**
 * Deep defensive merge for API data.
 * Ensures every array field is actually an array.
 * If API returns an object/null for an array field, uses fallback.
 */

interface LocalizedText {
  en: string | null;
  dari: string | null;
  pashto: string | null;
}

// Safe text accessor - no unsafe type casting
export function getText(localized: LocalizedText | null | undefined, lang: string): string {
  if (!localized) return "";
  // Access via bracket notation with proper type checking
  const value = localized[lang as keyof LocalizedText];
  if (typeof value === "string" && value.length > 0) return value;
  // Fallback to English
  if (typeof localized.en === "string" && localized.en.length > 0) return localized.en;
  return "";
}

// Safe array getter - returns T[] always
export function safeArray<T>(value: unknown, fallback: T[]): T[] {
  if (Array.isArray(value) && value.length > 0) return value as T[];
  return fallback;
}

// Safe object getter - returns T always (not never)
export function safeObject<T extends object>(value: unknown, fallback: T): T {
  if (value !== null && value !== undefined && typeof value === "object" && !Array.isArray(value)) {
    return value as T;
  }
  return fallback;
}

// Safe string getter
export function safeString(value: unknown, fallback: string): string {
  if (typeof value === "string" && value.length > 0) return value;
  return fallback;
}

// Safe number getter
export function safeNumber(value: unknown, fallback: number): number {
  const num = Number(value);
  if (!isNaN(num) && num !== 0) return num;
  return fallback;
}