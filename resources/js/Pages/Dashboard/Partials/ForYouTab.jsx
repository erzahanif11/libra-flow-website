export default function ForYouTab() {
    return (
        <div className="w-full grid grid-cols-2 md:grid-cols-4 gap-6">
            {[1, 2].map((i) => (
                <div
                    key={i}
                    className="w-full p-5 border-2 border-gray-100 rounded-lg animate-pulse"
                >
                    <div className="w-full aspect-[3/4] bg-gray-100 rounded-md mb-4"></div>
                    <div className="h-4 bg-gray-100 rounded w-1/2 mb-2"></div>
                    <div className="h-6 bg-gray-100 rounded w-full"></div>
                </div>
            ))}
            <div className="col-span-full py-10 text-center">
                <p className="font-secondary text-gray-400">
                    Tailored recommendations coming soon...
                </p>
            </div>
        </div>
    );
}
