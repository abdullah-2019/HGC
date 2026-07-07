"use client";

import ProjectHero from "../sections/ProjectHero";
import ProjectOverview from "../sections/ProjectOverview";
import ProjectGallery from "../sections/ProjectGallery";
import ProjectMilestones from "../sections/ProjectMilestones";

interface ProjectDetailClientProps {
  project: any;
}

export default function ProjectDetailClient({ project }: ProjectDetailClientProps) {
  return (
    <main className="min-h-screen bg-[#0A1628]">
      <ProjectHero project={project} />
      <ProjectOverview project={project} />
      <ProjectGallery project={project} />
      <ProjectMilestones project={project} />
    </main>
  );
}