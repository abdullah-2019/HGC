"use client";

import React from "react";
import ProductsHero from "./sections/ProductsHero";
import FeaturedProducts from "./sections/FeaturedProducts";
import ProductCategories from "./sections/ProductCategories";
import { useI18n } from "@/components/useI18nStore";

export default function ProductsPage() {
  const { dir } = useI18n();

  return (
    <div className="min-h-screen bg-[#0A1628]" dir={dir}>
      <ProductsHero />
      <FeaturedProducts />
      <ProductCategories />
    </div>
  );
}