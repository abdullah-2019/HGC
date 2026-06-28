import "./sections/about.css";
import HeroBanner from "./sections/HeroBanner";
import AboutStory from "./sections/AboutStory";
import ImageCarousel from "./sections/ImageCarousel";
import MissionSection from "./sections/MissionSection";
import VisionSection from "./sections/VisionSection";
import CoreValues from "./sections/CoreValues";
import LeadershipTeam from "./sections/LeadershipTeam";
import Timeline from "./sections/Timeline";
import StatsShowcase from "./sections/StatsShowcase";

export const metadata = {
  title: "About Us | Hafez Group of Companies",
  description: "Discover Hafez Group of Companies — Afghanistan's leading conglomerate since 2001. Construction, mining, logistics & financial services across 38+ provinces.",
};

export default function AboutPage() {
  return (
    <div className="about-page">
      <HeroBanner />
      <AboutStory />
      <StatsShowcase />
      <ImageCarousel />
      <MissionSection />
      <VisionSection />
      <CoreValues />
      <Timeline />
      <LeadershipTeam />
    </div>
  );
}