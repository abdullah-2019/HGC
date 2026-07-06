"use client";

import { useEffect, useState } from "react";
import { fetchContactInfo, ContactInfo } from "@/lib/api/contact";

interface UseContactInfoReturn {
  contactInfo: ContactInfo | null;
  isLoading: boolean;
  error: string | null;
}

export function useContactInfo(): UseContactInfoReturn {
  const [contactInfo, setContactInfo] = useState<ContactInfo | null>(null);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    let mounted = true;

    async function load() {
      try {
        setIsLoading(true);
        setError(null);

        console.log("[useContactInfo] Fetching contact info...");
        const data = await fetchContactInfo();

        console.log("[useContactInfo] Received data:", data);

        if (mounted) {
          setContactInfo(data);
        }
      } catch (err: any) {
        console.error("[useContactInfo] Error:", err);
        if (mounted) {
          setError(err.message || "Failed to load contact information");
          setContactInfo(null);
        }
      } finally {
        if (mounted) {
          setIsLoading(false);
        }
      }
    }

    load();

    return () => {
      mounted = false;
    };
  }, []);

  return { contactInfo, isLoading, error };
}