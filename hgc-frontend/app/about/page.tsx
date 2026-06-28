import { Metadata } from "next";
// import AboutPageClient from "./AboutPageClient";
import AboutPageClient from "./AboutPageClient";

export const metadata: Metadata = {
  title: "About Us | Hafez Group of Companies",
  description: "Discover Hafez Group of Companies — Afghanistan's leading conglomerate since 2001. Construction, mining, logistics & financial services across 38+ provinces.",
};

export default function AboutPage() {
  return <AboutPageClient />;
}