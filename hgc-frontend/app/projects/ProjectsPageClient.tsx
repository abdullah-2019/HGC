"use client";

import { useState, useEffect } from "react";
import ProjectsHero from "./sections/ProjectsHero";
import CompanyFilter from "./sections/CompanyFilter";
import ProjectsGrid from "./sections/ProjectsGrid";

const API_BASE = process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000/api";

export default function ProjectsPageClient() {
  const [activeCompany, setActiveCompany] = useState("all");
  const [projects, setProjects] = useState<any[]>([]);
  const [companies, setCompanies] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  // Fetch companies for filter
  useEffect(() => {
    fetch(`${API_BASE}/companies/for-filter`)
      .then((res) => res.json())
      .then((json) => {
        if (json.success) setCompanies(json.data);
      })
      .catch(() => {
        // Fallback to hardcoded if API fails
        setCompanies([]);
      });
  }, []);

  // Fetch projects
  useEffect(() => {
    setLoading(true);
    const url = activeCompany === "all" 
      ? `${API_BASE}/projects` 
      : `${API_BASE}/projects?company=${encodeURIComponent(activeCompany)}`;

    fetch(url)
      .then((res) => res.json())
      .then((json) => {
        if (json.success) {
          setProjects(json.data);
          setError(null);
        } else {
          setError(json.message || "Failed to load projects");
        }
      })
      .catch((err) => {
        setError("Network error. Please try again.");
      })
      .finally(() => {
        setLoading(false);
      });
  }, [activeCompany]);

  return (
    <main className="min-h-screen bg-[#0A1628]">
      <ProjectsHero />
      <CompanyFilter
        activeCompany={activeCompany}
        onCompanyChange={setActiveCompany}
        companies={companies}
      />
      <ProjectsGrid 
        projects={projects} 
        loading={loading} 
        error={error} 
      />
    </main>
  );
}