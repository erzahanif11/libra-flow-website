import { useState } from "react";

export default function PopularTab() {
    const [bookmarks, setBookmarks] = useState({});
    const toggleBookmark = (id) =>
        setBookmarks((prev) => ({ ...prev, [id]: !prev[id] }));

    return (
        <div className="w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            {[1, 2, 3, 4].map((id) => (
                <div
                    key={id}
                    className="w-full p-5 flex flex-col gap-6 border-2 border-gray-100 rounded-lg bg-white"
                >
                    <div className="w-full h-auto overflow-hidden rounded">
                        <img
                            className="w-full object-cover hover:scale-105 transition-transform duration-300"
                            src="/photo/ah.png"
                            alt="Atomic Habits"
                        />
                    </div>
                    <div className="h-24 flex flex-col gap-0.5">
                        <p className="font-secondary text-gray-400 text-sm">
                            Productivity
                        </p>
                        <h2 className="font-secondary text-lg font-semibold leading-tight text-tertiary">
                            Atomic Habits
                        </h2>
                        <p className="font-secondary text-gray-500 text-sm">
                            James Clear
                        </p>
                    </div>
                    <div className="flex justify-between items-center mt-auto">
                        <div className="flex gap-1.5 border-2 rounded-full px-3 py-1 border-gray-100 items-center">
                            <div className="bg-green-300 rounded-full w-2 h-2"></div>
                            <span className="text-gray-400 font-secondary text-xs font-medium">
                                Available
                            </span>
                        </div>
                        <button
                            onClick={() => toggleBookmark(id)}
                            className="focus:outline-none"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill={bookmarks[id] ? "currentColor" : "none"}
                                viewBox="0 0 24 24"
                                strokeWidth={1.5}
                                stroke="currentColor"
                                className={`w-6 h-6 transition-colors ${bookmarks[id] ? "text-tertiary" : "text-gray-300 hover:text-tertiary"}`}
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            ))}
        </div>
    );
}
