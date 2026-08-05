"use client";

import React, { useState, useRef } from "react";
import { Play, Pause, Volume2, VolumeX, Maximize } from "lucide-react";

interface VideoSectionProps {
  videoUrl?: string;
  posterUrl?: string;
  title?: string;
  subtitle?: string;
}

export default function VideoSection({
  videoUrl = "https://www.youtube.com/embed/dQw4w9WgXcQ",
  posterUrl,
  title = "Building Afghanistan's Future",
  subtitle = "Watch how Hafez Group transforms infrastructure across 38+ provinces",
}: VideoSectionProps) {
  const [isPlaying, setIsPlaying] = useState(false);
  const [isMuted, setIsMuted] = useState(true);
  const iframeRef = useRef<HTMLIFrameElement>(null);

  const isYouTube = videoUrl.includes("youtube") || videoUrl.includes("youtu.be");

  const handlePlay = () => {
    setIsPlaying(!isPlaying);
  };

  return (
    <section className="relative py-20 lg:py-28 overflow-hidden">
      {/* Subtle background gradient */}
      <div className="absolute inset-0 bg-hgc-bg-alt" />

      {/* Thin stripe decoration (top) */}
      <div className="absolute top-0 left-0 right-0 h-px bg-hgc-header-border" />

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
          <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-hgc-header-bg-hover border border-hgc-header-border mb-6">
            <span className="w-1.5 h-1.5 rounded-full bg-hgc-accent" />
            <span className="text-hgc-header-text-muted text-xs font-medium uppercase tracking-wider">
              Featured Video
            </span>
          </div>

          <h2 className="text-hgc-header-text text-3xl lg:text-4xl font-bold leading-tight mb-4">
            {title}
          </h2>

          <p className="text-hgc-header-text-faint text-base lg:text-lg leading-relaxed">
            {subtitle}
          </p>
        </div>

        {/* Video Container */}
        <div className="relative max-w-5xl mx-auto">
          {/* Decorative glow behind video */}
          <div className="absolute -inset-4 lg:-inset-8 bg-hgc-header-bg-start/5 rounded-[2rem] blur-2xl" />

          <div className="relative rounded-2xl lg:rounded-3xl overflow-hidden bg-hgc-header-text shadow-2xl shadow-hgc-header-text/10 border border-hgc-header-border">
            {/* Video Aspect Ratio Container */}
            <div className="relative aspect-video">
              {isYouTube ? (
                <iframe
                  ref={iframeRef}
                  src={`${videoUrl}${videoUrl.includes("?") ? "&" : "?"}autoplay=${isPlaying ? 1 : 0}&mute=${isMuted ? 1 : 0}&rel=0&modestbranding=1`}
                  title="Hafez Group Video"
                  className="absolute inset-0 w-full h-full"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowFullScreen
                />
              ) : (
                <video
                  src={videoUrl}
                  poster={posterUrl}
                  className="absolute inset-0 w-full h-full object-cover"
                  controls
                  playsInline
                />
              )}

              {/* Custom Play Overlay (for YouTube before interaction) */}
              {isYouTube && !isPlaying && (
                <div
                  className="absolute inset-0 flex items-center justify-center bg-hgc-header-text/40 backdrop-blur-sm cursor-pointer group"
                  onClick={handlePlay}
                >
                  <div className="w-20 h-20 lg:w-24 lg:h-24 rounded-full bg-hgc-accent/90 flex items-center justify-center shadow-lg shadow-hgc-accent/30 group-hover:scale-110 transition-transform duration-300">
                    <Play className="w-8 h-8 lg:w-10 lg:h-10 text-hgc-header-text ml-1" fill="currentColor" />
                  </div>
                </div>
              )}
            </div>

            {/* Video Info Bar */}
            <div className="flex items-center justify-between px-4 lg:px-6 py-3 bg-hgc-header-text border-t border-hgc-header-border">
              <div className="flex items-center gap-3">
                <div className="w-2 h-2 rounded-full bg-hgc-accent animate-pulse" />
                <span className="text-hgc-accent/80 text-xs lg:text-sm font-medium">
                  Hafez Group of Companies
                </span>
              </div>

              <div className="flex items-center gap-2">
                <span className="text-hgc-header-text-ghost text-xs hidden sm:inline">
                  24+ Years of Excellence
                </span>
              </div>
            </div>
          </div>
        </div>

        {/* Stats Row */}
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 max-w-4xl mx-auto mt-12 lg:mt-16">
          {[
            { value: "200+", label: "Projects Completed" },
            { value: "38+", label: "Provinces Covered" },
            { value: "7", label: "Subsidiary Companies" },
            { value: "24+", label: "Years of Service" },
          ].map((stat) => (
            <div
              key={stat.label}
              className="text-center p-4 lg:p-5 rounded-xl bg-hgc-header-bg-hover border border-hgc-header-border hover:border-hgc-accent/20 transition-all duration-300"
            >
              <p className="text-hgc-header-text text-2xl lg:text-3xl font-bold mb-1">
                {stat.value}
              </p>
              <p className="text-hgc-header-text-faint text-xs lg:text-sm">
                {stat.label}
              </p>
            </div>
          ))}
        </div>
      </div>

      {/* Thin stripe decoration (bottom) */}
      <div className="absolute bottom-0 left-0 right-0 h-px bg-hgc-header-border" />
    </section>
  );
}