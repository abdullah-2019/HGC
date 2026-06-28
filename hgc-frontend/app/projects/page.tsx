import { Metadata } from "next";
import ProjectsPageClient from "./ProjectsPageClient";

export const metadata: Metadata = {
  title: "Projects | Hafez Group of Companies",
  description: "Explore HGC's portfolio of construction, mining, solar, and infrastructure projects across Afghanistan's 38+ provinces.",
};

export default function ProjectsPage() {
  return <ProjectsPageClient />;
}