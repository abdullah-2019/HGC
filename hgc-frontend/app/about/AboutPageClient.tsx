"use client";

import "./sections/about.css";
import HeroBanner from "./sections/HeroBanner";
import AboutStory from "./sections/AboutStory";
import ImageCarousel from "./sections/ImageCarousel";
import MissionSection from "./sections/MissionSection";
import VisionSection from "./sections/VisionSection";
import CoreValues from "./sections/CoreValues";
import StatsShowcase from "./sections/StatsShowcase";
import { AboutPageData } from "./page";

interface AboutPageClientProps {
  data: AboutPageData;
}

export default function AboutPageClient({ data }: AboutPageClientProps) {
  return (
    <div className="about-page">
      <HeroBanner settings={data.settings} />
      <AboutStory story={data.story} />
      <StatsShowcase stats={data.stats} />
      <ImageCarousel slides={data.carousel} />
      <MissionSection mission={data.mission} />
      <VisionSection vision={data.vision} />
      <CoreValues coreValues={data.coreValues} />
    </div>
  );
}