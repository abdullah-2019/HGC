"use client";

import { useState } from "react";
import ProjectsHero from "./sections/ProjectsHero";
import CompanyFilter from "./sections/CompanyFilter";
import ProjectsGrid from "./sections/ProjectsGrid";

export default function ProjectsPageClient() {
  const [activeCompany, setActiveCompany] = useState("all");

  return (
    <main className="min-h-screen bg-[#0A1628]">
      <ProjectsHero />
      <CompanyFilter
        activeCompany={activeCompany}
        onCompanyChange={setActiveCompany}
      />
      <ProjectsGrid activeCompany={activeCompany} />
    </main>
  );
}