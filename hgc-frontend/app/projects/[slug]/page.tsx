import { Metadata } from "next";
import { notFound } from "next/navigation";
import ProjectDetailClient from "./ProjectDetailClient";

// Your .env has: NEXT_PUBLIC_API_URL=http://localhost:8000
const API_BASE = `${process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000"}/api`;

async function getProject(slug: string) {
  try {
    const res = await fetch(`${API_BASE}/projects/${slug}`, {
      next: { revalidate: 60 },
    });
    if (!res.ok) return null;
    const json = await res.json();
    return json.success ? json.data : null;
  } catch (err) {
    console.error("Failed to fetch project:", err);
    return null;
  }
}

export async function generateMetadata({ params }: { params: Promise<{ slug: string }> }): Promise<Metadata> {
  const { slug } = await params;
  const project = await getProject(slug);
  
  if (!project) {
    return { title: "Project Not Found | HGC" };
  }
  
  return {
    title: `${project.nameEn} | HGC Projects`,
    description: project.overviewEn?.slice(0, 160) || "Hafez Group project details",
    openGraph: {
      images: project.heroImage ? [{ url: project.heroImage }] : [],
    },
  };
}

export default async function ProjectPage({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params;
  const project = await getProject(slug);
  
  if (!project) notFound();
  
  return <ProjectDetailClient project={project} />;
}