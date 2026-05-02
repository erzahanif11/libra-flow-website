export default function BorrowedTab() {
    return (
        <div className="w-full py-20 flex flex-col items-center justify-center border-2 border-dashed border-gray-100 rounded-2xl">
            <div className="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    strokeWidth={1.5}
                    stroke="currentColor"
                    className="w-8 h-8 text-gray-300"
                >
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25"
                    />
                </svg>
            </div>
            <h3 className="font-secondary text-gray-500 font-medium text-lg">
                No active loans
            </h3>
            <p className="font-secondary text-gray-400 text-sm">
                Borrow a book to see it here.
            </p>
        </div>
    );
}
