import { Metadata } from "next";
import HeroSection from "./sections/HeroSection";
import StatsBar from "./sections/StatsBar";
import AboutSection from "./sections/AboutSection";
import CompaniesSection from "./sections/CompaniesSection";
import ProductsSection from "./sections/ProductsSection";
import SectorsSection from "./sections/SectorsSection";
import ProjectsSection from "./sections/ProjectsSection";
import PartnersSection from "./sections/PartnersSection";
import WhyChooseSection from "./sections/WhyChooseSection";
import ClientsSection from "./sections/ClientsSection";
import TestimonialsSection from "./sections/TestimonialsSection";
import CTASection from "./sections/CTASection";

export const metadata: Metadata = {
  title: "Hafez Group of Companies | Building Afghanistan's Future",
  description:
    "Hafez Group of Companies (HGC) — Construction, Mining, Logistics & Financial Services. 24+ years, 200+ projects, 38+ provinces across Afghanistan.",
};

export default function HomePage() {
  return (
    <div className="overflow-hidden">
      <HeroSection />
      <StatsBar />
      <AboutSection />
      <CompaniesSection />
      <ProductsSection />
      <SectorsSection />
      <ProjectsSection />
      <PartnersSection />
      <WhyChooseSection />
      <ClientsSection />
      <TestimonialsSection />
      <CTASection />
    </div>
  );
}