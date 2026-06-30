import CompanyProfileHero from "./sections/CompanyProfileHero";
import CompanyAbout from "./sections/CompanyAbout";
import CompanyMissionVision from "./sections/CompanyMissionVision";
import CompanyHistory from "./sections/CompanyHistory";
import CompanyStats from "./sections/CompanyStats";
import CompanyLeadership from "./sections/CompanyLeadership";
import CompanyValues from "./sections/CompanyValues";
import CompanyAwards from "./sections/CompanyAwards";

export const metadata = {
  title: "Company Profile - Hafez Group of Companies",
  description: "Learn about Hafez Group of Companies - our history, mission, values, and leadership.",
};

export default function CompanyProfilePage() {
  return (
    <main className="min-h-screen bg-[#0A1628]">
      <CompanyProfileHero />
      <CompanyAbout />
      <CompanyStats />
      <CompanyMissionVision />
      <CompanyHistory />
      <CompanyValues />
      <CompanyLeadership />
      <CompanyAwards />
    </main>
  );
}