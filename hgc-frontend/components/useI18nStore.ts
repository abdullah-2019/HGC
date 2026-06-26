"use client";

import { create } from "zustand";
import { persist } from "zustand/middleware";

export type Lang = "en" | "dari" | "pashto";

interface I18nStore {
  lang: Lang;
  dir: "ltr" | "rtl";
  setLang: (lang: Lang) => void;
}

export const useI18nStore = create<I18nStore>()(
  persist(
    (set) => ({
      lang: "en",
      dir: "ltr",
      setLang: (lang: Lang) =>
        set({
          lang,
          dir: lang === "en" ? "ltr" : "rtl",
        }),
    }),
    {
      name: "hgc-lang-storage",
      partialize: (state) => ({ lang: state.lang }),
      onRehydrateStorage: () => (state) => {
        if (state) {
          state.dir = state.lang === "en" ? "ltr" : "rtl";
        }
      },
    }
  )
);

// Hook for components - use individual selectors to avoid object creation
export function useI18n() {
  const lang = useI18nStore((state) => state.lang);
  const dir = useI18nStore((state) => state.dir);
  const setLang = useI18nStore((state) => state.setLang);

  return { lang, dir, setLang };
}