"use client";

import { useState, useEffect } from "react";
import { Loader2 } from "lucide-react";

interface VideoData {
  id: number;
  video_file: string | null;
  video_url: string | null;
}

export default function VideoSection() {
  const [video, setVideo] = useState<VideoData | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchVideo = async () => {
      try {
        setLoading(true);
        const res = await fetch(
          `${process.env.NEXT_PUBLIC_API_URL}/api/videos`,
          { headers: { Accept: "application/json" } }
        );
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const json = await res.json();
        if (json.success) {
          setVideo(json.data);
        }
      } catch (err) {
        console.error("Video fetch error:", err);
        setVideo(null);
      } finally {
        setLoading(false);
      }
    };
    fetchVideo();
  }, []);

  /* Loading */
  if (loading) {
    return (
      <section className="py-16 bg-hgc-bg-alt">
        <div className="max-w-5xl mx-auto px-4 flex items-center justify-center min-h-[300px]">
          <Loader2 className="w-10 h-10 text-hgc-gold animate-spin" />
        </div>
      </section>
    );
  }

  /* No active video — hide entire section */
  if (!video || (!video.video_file && !video.video_url)) {
    return null;
  }

  /* Safe local copy for TypeScript */
  const videoUrl = video.video_url ?? "";
  const isYouTube =
    videoUrl.includes("youtube") || videoUrl.includes("youtu.be");

  return (
    <section className="py-16 lg:py-24 bg-hgc-bg-alt">
      <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="relative rounded-2xl lg:rounded-3xl overflow-hidden bg-hgc-card-alt shadow-2xl border border-hgc-border">
          <div className="relative aspect-video">
            {video.video_file ? (
              /* Local video takes priority */
              <video
                src={video.video_file}
                controls
                playsInline
                className="absolute inset-0 w-full h-full"
              />
            ) : isYouTube ? (
              /* YouTube fallback */
              <iframe
                src={`${videoUrl}${videoUrl.includes("?") ? "&" : "?"}rel=0&modestbranding=1`}
                title="Video"
                className="absolute inset-0 w-full h-full"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowFullScreen
              />
            ) : (
              /* Generic embed fallback */
              <iframe
                src={videoUrl}
                title="Video"
                className="absolute inset-0 w-full h-full"
                allowFullScreen
              />
            )}
          </div>
        </div>
      </div>
    </section>
  );
}