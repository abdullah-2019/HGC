"use client";

import { useState, useEffect } from "react";
import ProjectsHero from "./sections/ProjectsHero";
import CompanyFilter from "./sections/CompanyFilter";
import ProjectsGrid from "./sections/ProjectsGrid";

const API_BASE = `${process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000"}/api`;

interface Project {
  id: number;
  slug: string;
  nameEn: string;
  nameDari: string;
  locationEn: string;
  locationDari: string;
  clientEn: string;
  clientDari: string;
  duration: string;
  status: "completed" | "ongoing" | "planned";
  category: string;
  descriptionEn: string;
  descriptionDari: string;
  coverImage: string;
  completionPercent: number;
  companyColor: string;
  companySlug: string;
}

interface CompanyFilterItem {
  id: string;
  slug: string;
  nameEn: string;
  nameDari: string;
  icon: string;
  color: string;
}

export default function ProjectsPageClient() {
  const [activeCompany, setActiveCompany] = useState<string>("all");
  const [projects, setProjects] = useState<Project[]>([]);
  const [companies, setCompanies] = useState<CompanyFilterItem[]>([]);
  const [loading, setLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  // Fetch companies for filter
  useEffect(() => {
    fetch(`${API_BASE}/companies/for-filter`)
      .then((res) => {
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return res.json();
      })
      .then((json: { success: boolean; data?: CompanyFilterItem[] }) => {
        if (json.success && json.data && json.data.length > 0) {
          setCompanies(json.data);
        } else {
          setCompanies([]);
        }
      })
      .catch((err: Error) => {
        // console.error("Companies API failed:", err.message);
        setCompanies([]);
      });
  }, []);

  // Fetch projects
  useEffect(() => {
    setLoading(true);
    setError(null);

    const url =
      activeCompany === "all"
        ? `${API_BASE}/projects`
        : `${API_BASE}/projects?company=${encodeURIComponent(activeCompany)}`;

    fetch(url)
      .then((res) => {
        if (!res.ok) throw new Error(`HTTP ${res.status}: ${res.statusText}`);
        return res.json();
      })
      .then((json: { success: boolean; data?: Project[]; message?: string }) => {
        if (json.success && json.data) {
          setProjects(json.data);
          setError(null);
        } else {
          throw new Error(json.message || "Invalid response format");
        }
      })
      .catch((err: Error) => {
        console.error("Projects fetch failed:", err.message);
        setProjects([]);
        setError("API connection issue — unable to load projects.");
      })
      .finally(() => {
        setLoading(false);
      });
  }, [activeCompany]);

  const hasProjects = projects.length > 0;

  return (
    <main className="min-h-screen bg-[#0A1628]">
      <ProjectsHero />
      <CompanyFilter
        activeCompany={activeCompany}
        onCompanyChange={setActiveCompany}
        companies={companies}
      />

      {/* API Error */}
      {error && (
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
          <div className="bg-red-500/10 border border-red-500/20 rounded-xl p-4 text-center">
            <p className="text-red-400 text-sm font-medium">
              ⚠️ {error}
            </p>
          </div>
        </div>
      )}

      {/* Empty State */}
      {!loading && !error && !hasProjects && (
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
          <div className="bg-white/[0.02] border border-white/5 rounded-2xl p-12">
            <p className="text-white/30 text-lg mb-2">No projects found</p>
            <p className="text-white/20 text-sm">
              Try selecting a different company filter.
            </p>
          </div>
        </div>
      )}

      {/* Projects Grid */}
      {hasProjects && (
        <ProjectsGrid
          projects={projects}
          loading={loading}
          error={error}
        />
      )}
    </main>
  );
}