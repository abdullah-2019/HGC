"use client";

import "./sections/about.css";
import HeroBanner from "./sections/HeroBanner";
import AboutStory from "./sections/AboutStory";
import ImageCarousel from "./sections/ImageCarousel";
import MissionSection from "./sections/MissionSection";
import VisionSection from "./sections/VisionSection";
import CoreValues from "./sections/CoreValues";
import StatsShowcase from "./sections/StatsShowcase";

export default function AboutPageClient() {
  return (
    <div className="about-page">
      <HeroBanner />
      <AboutStory />
      <StatsShowcase />
      <ImageCarousel />
      <MissionSection />
      <VisionSection />
      <CoreValues />
    </div>
  );
}