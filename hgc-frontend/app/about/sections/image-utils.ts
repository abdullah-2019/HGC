// components/about/image-utils.ts
// REMOVE "use client" — this is a pure utility, not a React component

/**
 * Resolves image URLs from Laravel storage to full, correct URLs.
 * Fixes the bug where Laravel returns https://hgc.af/... instead of https://api.hgc.af/...
 */

const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL?.replace(/\/$/, "") || "https://api.hgc.af";

export function resolveImageUrl(path: string | null | undefined): string {
  if (!path || typeof path !== "string") return "/images/placeholder.png";

  // 1. Already correct API URL — return as-is
  if (path.startsWith(API_BASE_URL)) {
    return path;
  }

  // 2. Wrong domain: https://hgc.af/... → https://api.hgc.af/...
  if (/^https?:\/\/hgc\.af/.test(path)) {
    return path.replace(/^https?:\/\/hgc\.af/, API_BASE_URL);
  }

  // 3. Other absolute URL (external CDN, S3, etc.) — return as-is
  if (path.startsWith("http://") || path.startsWith("https://")) {
    return path;
  }

  // 4. Relative path starting with /storage/... or /uploads/...
  if (path.startsWith("/")) {
    return `${API_BASE_URL}${path}`;
  }

  // 5. Bare filename like "uploads/projects/gallery/xxx.jpeg"
  return `${API_BASE_URL}/storage/${path}`;
}