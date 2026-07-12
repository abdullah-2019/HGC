"use client";

/**
 * Resolves image URLs from Laravel storage to full URLs.
 * Handles both relative paths and already-absolute URLs.
 */

export function resolveImageUrl(path: string | null | undefined): string {
  if (!path || typeof path !== "string") return "/images/placeholder.png";

  // Already a full URL (starts with http:// or https://)
  if (path.startsWith("http://") || path.startsWith("https://")) {
    return path;
  }

  // Already starts with / — use as-is
  if (path.startsWith("/")) {
    return path;
  }

  // Relative path like "uploads/hero-construction.webp"
  // Prepend the API base URL + /storage/
  const baseUrl = process.env.NEXT_PUBLIC_API_URL?.replace(/\/$/, "") || "http://localhost:8000";
  return `${baseUrl}/storage/${path}`;
}